import { z } from 'zod'
import { FastifyReply, FastifyRequest } from 'fastify'
import { MakeUpdateCarUseCase } from '@/use-cases/factories/make-car-factory'

export async function createCarController(
  request: FastifyRequest,
  reply: FastifyReply,
) {
  const updateCarParamsSchema = z.object({
    carId: z.string().uuid(),
  })
  const updateCarBodySchema = z.object({
    brand: z.string(),
    model: z.string(),
    year: z.number(),
    color: z.string(),
  })

  const { carId } = updateCarParamsSchema.parse(request.params)
  const { brand, color, model, year } = updateCarBodySchema.parse(request.body)

  const updateCarUseCase = MakeUpdateCarUseCase()

  await updateCarUseCase.execute({
    carId,
    brand,
    color,
    model,
    year,
  })

  return reply.status(201).send()
}
